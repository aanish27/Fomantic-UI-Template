<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.3/dist/semantic.min.js"></script>
    </head>
    <body style="background-color: #f9f9f9;">
        <x-guest-nav page="login"/>

       <div class="ui middle aligned center aligned grid" style="height: 100vh;">
            <div class="column" style="max-width: 400px;">
                <h2 class="ui header"> Vista G </h2>
                <form method="POST" class="ui large form" action="{{ route('login') }}">
                    @csrf
                    <div class="ui stacked segment">
                        <div class="ui error message"></div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="envelope icon"></i>
                                <input id="email" type="email" name="email" placeholder="Email" autofocus autocomplete="username">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input id="password" type="password" name="password" placeholder="Password"  autocomplete="current-password">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox">
                                <label>Remember Me</label>
                            </div>
                        </div>
                    </div>
                    <button class="ui fluid primary button">Sign In</button>
                </form>

                <div class="ui horizontal divider">OR</div>
                <div class="ui left floated">
                    <a href="#">Register a new membership</a><br>
                    <a href="#">I forgot my password</a>
                </div>
            </div>

        </div>
        <script type="module">
            $(function () {
                $('.ui.form').form({
                    fields: {
                        email: {
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Please enter your email'
                                }
                            ]
                        },
                        password: {
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Please Enter the password'
                                }
                            ]
                        },
                    }
                });

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    $.toast({
                        class: 'error',
                        message: "{{ $error }}"
                    });
                @endforeach
            @endif
            
        });
        </script>
    </body>
</html>
