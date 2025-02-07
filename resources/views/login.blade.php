<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background-color: #f9f9f9;">
       <div class="ui middle aligned center aligned grid" style="height: 100vh;">
            <div class="column" style="max-width: 400px;">
                <h2 class="ui header"> Admin LTE </h2>
                <form class="ui large form">
                    <div class="ui stacked segment">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="envelope icon"></i>
                                <input type="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox">
                                <label>Remember Me</label>
                            </div>
                        </div>
                        <button class="ui fluid primary button">Sign In</button>
                    </div>
                </form>
                <div class="ui horizontal divider">OR</div>
                <button class="ui fluid facebook button">
                    <i class="facebook icon"></i> Sign in using Facebook
                </button>
                <br>
                <button class="ui fluid google plus button">
                    <i class="google plus icon"></i> Sign in using Google+
                </button>
                <div class="ui left floated">
                    <a href="#">Register a new membership</a><br>
                    <a href="#">I forgot my password</a>
                </div>
            </div>
        </div>
    </body>
</html>
