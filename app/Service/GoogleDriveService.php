<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    private $client;
    private $service;

    public function __construct()
    {
        $this->initializeClient();
        $this->service = new Google_Service_Drive($this->client);
    }

    private function initializeClient()
    {
        try {
            $this->client = new Google_Client();

            // Set credentials untuk Service Account
            $credentials = [
                'type' => 'service_account',
                'project_id' => config('filesystems.disks.google.project_id'),
                'private_key_id' => config('filesystems.disks.google.private_key_id'),
                'private_key' => config('filesystems.disks.google.private_key'),
                'client_email' => config('filesystems.disks.google.client_email'),
                'client_id' => config('filesystems.disks.google.client_id'),
                'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                'token_uri' => 'https://oauth2.googleapis.com/token',
            ];

            $this->client->setAuthConfig($credentials);
            $this->client->addScope(Google_Service_Drive::DRIVE);

            Log::info('Google Drive Service Account initialized successfully');

        } catch (\Exception $e) {
            Log::error('Failed to initialize Google Drive client: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Upload file ke Google Drive
     */
    public function uploadFile($filePath, $fileName, $mimeType = null)
    {
        try {
            $folderId = config('filesystems.disks.google.folderId');

            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $fileName,
                'parents' => [$folderId]
            ]);

            $content = file_get_contents($filePath);

            $file = $this->service->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $mimeType,
                'uploadType' => 'multipart',
                'fields' => 'id'
            ]);

            Log::info("File uploaded successfully: {$fileName}, ID: {$file->id}");

            return $file->id;

        } catch (\Exception $e) {
            Log::error("Failed to upload file {$fileName}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Download file dari Google Drive
     */
    public function downloadFile($fileId, $savePath = null)
    {
        try {
            $response = $this->service->files->get($fileId, [
                'alt' => 'media'
            ]);

            $content = $response->getBody()->getContents();

            if ($savePath) {
                file_put_contents($savePath, $content);
                Log::info("File downloaded and saved to: {$savePath}");
            }

            return $content;

        } catch (\Exception $e) {
            Log::error("Failed to download file {$fileId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete file dari Google Drive
     */
    public function deleteFile($fileId)
    {
        try {
            $this->service->files->delete($fileId);
            Log::info("File deleted successfully: {$fileId}");
            return true;

        } catch (\Exception $e) {
            Log::error("Failed to delete file {$fileId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get file info
     */
    public function getFileInfo($fileId)
    {
        try {
            $file = $this->service->files->get($fileId, [
                'fields' => 'id,name,mimeType,size,createdTime,modifiedTime'
            ]);

            return [
                'id' => $file->getId(),
                'name' => $file->getName(),
                'mimeType' => $file->getMimeType(),
                'size' => $file->getSize(),
                'createdTime' => $file->getCreatedTime(),
                'modifiedTime' => $file->getModifiedTime()
            ];

        } catch (\Exception $e) {
            Log::error("Failed to get file info {$fileId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * List files dalam folder
     */
    public function listFiles($folderId = null, $pageSize = 10)
    {
        try {
            $folderId = $folderId ?: config('filesystems.disks.google.folderId');

            $optParams = [
                'pageSize' => $pageSize,
                'fields' => 'nextPageToken, files(id, name, mimeType, size, createdTime)',
                'q' => "'{$folderId}' in parents and trashed=false"
            ];

            $results = $this->service->files->listFiles($optParams);

            return $results->getFiles();

        } catch (\Exception $e) {
            Log::error("Failed to list files in folder {$folderId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create sharing link
     */
    public function createSharingLink($fileId, $type = 'reader')
    {
        try {
            $permission = new \Google_Service_Drive_Permission([
                'type' => 'anyone',
                'role' => $type
            ]);

            $this->service->permissions->create($fileId, $permission);

            $file = $this->service->files->get($fileId, [
                'fields' => 'webViewLink,webContentLink'
            ]);

            return [
                'view_link' => $file->getWebViewLink(),
                'download_link' => $file->getWebContentLink()
            ];

        } catch (\Exception $e) {
            Log::error("Failed to create sharing link for {$fileId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Check connection
     */
    public function testConnection()
    {
        try {
            $folderId = config('filesystems.disks.google.folderId');
            $folder = $this->service->files->get($folderId);

            Log::info("Google Drive connection successful. Folder: {$folder->getName()}");
            return true;

        } catch (\Exception $e) {
            Log::error("Google Drive connection failed: " . $e->getMessage());
            return false;
        }
    }
}