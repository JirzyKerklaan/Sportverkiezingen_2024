# statamic-template
Ongoing process of an ever growing template for Esens Design  
  
## Installation instructions

1. run `composer install`
2. run `php please make:user` if there isnt one yet
3. run `npm install`
4. Run `npm run dev` to run vite and watch for changes.
   1. Additionaly, we can expose vite to our network so we can see it on YOUR_LOCAL_IP:3000
   2. For this to work edit `APP_IP` in your .env to your local IP address
   3. Run `npm run watch` to run it like this.  
5. Run `npm run prod` to compile the resources file for production with vite.

## Info
For more info about statamic, like production environments or deploying on the VPS see [this repository](https://github.com/Esens-Design/statamic-info)   
