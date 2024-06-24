# pdf-form-service

<p>
This is a microservice prototype based on a clients requirements. Its characteristics are:
</p>

<ul>
<li>Generate custom pdfs forms with fillable fields</li>
<li>Works on aws lambda functions</li>
<li>Implements github actions CI pipeline</li>
</ul>

<p>As aws lambda functions do not suport PHP natively, it uses a very neat setup with 'Bref', which uses aws cloudformation to create the environment. For more informations on 'Bref' check:</p>

<a href="https://bref.sh/">https://bref.sh/</a>

## Local

For compser dependencies run:

    composer install

Install AWS CLI, and setup your aws keys:

    npm install -g serverless@3
    serverless config credentials --provider aws --key "key" --secret "secret"

## Deploy

Clean local cache:

    php artisan config:clear

Run deploy:

    serverless deploy

 
