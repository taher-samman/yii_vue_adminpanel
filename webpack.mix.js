const mix = require('laravel-mix');

mix.js([
            'app/mern/app.js'
      ], 'web/assets/js/mern.js')
      .setPublicPath('backend')
      .vue();