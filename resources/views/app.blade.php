<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Burns Web Services</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600"
          rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'
          rel="stylesheet">
    <link type="text/css"
          rel="stylesheet"
          href="{{ mix('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    <v-app>
        <v-toolbar app>
            <topnav></topnav>
        </v-toolbar>
        <v-content>
            <v-container fluid
                         class="pa-2 ma-2">
                <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
