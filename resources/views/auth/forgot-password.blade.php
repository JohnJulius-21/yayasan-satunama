<div class="container">


    <form action="{{ route('reset.password.check') }}" method="POST" class="login">
        @csrf
        @if (Session::has('success'))
            <div class="pt-3">
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif

        @if (Session::has('error'))
            <div class="pt-3">
                <div class="alert alert-error" role="alert">
                    {{ Session::get('error') }} {{-- Perbaikan di sini --}}
                </div>
            </div>
        @endif
        <label>Masukkan Username atau Email:</label>
        <input type="text" name="username" required>
        <button type="submit">Lanjut</button>
        <a href="{{ route('adminLogin') }}">Kembali</a>
    </form>

</div>




<style>
    @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    body {
        background: #cacaca;
        font-family: Raleway, sans-serif;
        color: #666;
    }

    .login {
        margin: 150px auto;
        padding: 40px 50px;
        max-width: 500px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 1px 1px 1px #666;
    }

    .login input {
        width: 100%;
        display: block;
        box-sizing: border-box;
        margin: 10px 0;
        padding: 14px 12px;
        font-size: 16px;
        border-radius: 2px;
        font-family: Raleway, sans-serif;
    }

    .login img {
        display: block;
        margin: 0 auto;
        /* Memusatkan gambar secara horizontal */
        width: 50%;
        padding: 14px 12px;
    }


    .login input[type=text],
    .login input[type=password] {
        border: 1px solid #c0c0c0;
        transition: .2s;
    }

    .login input[type=text]:hover {
        border-color: #1a6304;
        outline: none;
        transition: all .2s ease-in-out;
    }

    .login button[type=submit] {
        width: 100%;
        display: block;
        box-sizing: border-box;
        border: none;
        background: #1a6304;
        color: white;
        font-weight: bold;
        transition: 0.2s;
        margin: 20px 0px;
        padding: 14px 12px;
        font-size: 16px;
        border-radius: 2px;
        font-family: Raleway, sans-serif;
    }

    .login button[type=submit]:hover {
        background: #1a6304;
    }

    .login h2 {
        margin: 20px 0 0;
        color: #1a6304;
        font-size: 28px;
    }

    .login p {
        margin-bottom: 40px;
        margin-top: 20px;
        font-size: 18px;
    }

    .links {
        display: table;
        width: 100%;
        box-sizing: border-box;
        border-top: 1px solid #c0c0c0;
        margin-bottom: 10px;
    }

    .links a {
        display: table-cell;
        padding-top: 10px;
    }

    .links a:first-child {
        text-align: left;
    }

    .links a:last-child {
        text-align: right;
    }

    .login h2,
    .login p,
    .login a {
        text-align: center;
    }

    .login a {
        text-decoration: none;
        font-size: .8em;
    }

    .login a:visited {
        color: inherit;
    }

    .login a:hover {
        text-decoration: underline;
    }


    /* /* @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300); */

    *,
    *:before,
    *:after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* body,
    html {
        width: 100%;
        height: 100%;
        padding: 25px;

        background-color: #f9f9f9;
    } */

    .alert {
        margin: 10px 0px;
        padding: 12px;
        border-radius: 5px;

        font-family: 'Open Sans', sans-serif;
        font-size: .9rem;
        font-weight: 300;
        letter-spacing: 1px;
    }

    .alert:hover {
        cursor: pointer;
    }

    .alert:before {
        padding-right: 12px;
    }

    .alert:after {
        content: '\f00d';
        font-family: 'FontAwesome';
        float: right;
        padding: 3px;

        &:hover {
            cursor: pointer;
        }
    }

    .alert-info {
        color: #00529B;
        background-color: #BDE5F8;
        border: 1px solid darken(#BDE5F8, 15%);
    }

    .alert-info:before {
        content: '\f05a';
        font-family: 'FontAwesome';
    }

    .alert-warn {
        color: #9F6000;
        background-color: #FEEFB3;
        border: 1px solid darken(#FEEFB3, 15%);
    }

    .alert-warn:before {
        content: '\f071';
        font-family: 'FontAwesome';
    }

    .alert-error {
        color: #D8000C;
        background-color: #FFBABA;
        border: 1px solid darken(#FFBABA, 15%);
    }

    .alert-error:before {
        content: '\f057';
        font-family: 'FontAwesome';
    }

    .alert-success {
        color: #4F8A10;
        background-color: #DFF2BF;
        border: 1px solid darken(#DFF2BF, 15%);
    }

    .alert-success:before {
        content: '\f058';
        font-family: 'FontAwesome';
    }
</style>

<!-- Tambahkan ini sebelum skrip JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.alert').click(function() {
            $(this).fadeOut();
        });
    });
</script>
