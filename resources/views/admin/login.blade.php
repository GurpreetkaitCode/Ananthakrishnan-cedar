<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN</title>
    <style>
        .error {
            color: red;
            background-color: rgba(255, 0, 0, 0.24);
            border: 1px solid red;
            padding: 10px;
            border-radius: 15px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <main class="main">
        <div class="container">
            <section class="wrapper">
                <div class="heading">
                    <h1 class="text text-large">Sign In</h1>
                </div>
                @if($errors->any())
                @foreach ($errors->all() as $error)
                <div class="error">{{$error}}</div>
                @endforeach
                @endif
                <form method="POST" action="{{ route('login') }}" class="form">
                    @csrf
                    <div class="input-control">
                        <label for="email" class="input-label" hidden>Email Address</label>
                        <input type="email" name="email" id="email" class="input-field" placeholder="Email Address"
                            :value="old('email')" required autofocus />
                    </div>
                    <div class="input-control">
                        <label for="password" :value="__('Password')" class="input-label" hidden>Password</label>
                        <input type="password" name="password" id="password" class="input-field"
                            placeholder="Password" />
                    </div>
                    <div class="input-control" style="justify-content: center;">
                        <button name="submit" class="input-submit">
                            Sign In
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>

</html>

<script>

</script>