Laravel - Stripe Payment Gateway Integration Example
After Payment also Send an email to that user
Set your stripe developer publisher key and secret key information in .env file
STRIPE_KEY=pk_test_your_publishable_key
STRIPE_SECRET=sk_test_your_secret_key
Set your mailtrap information in .env file 
For Example :
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your mailtrap user name
MAIL_PASSWORD=your mailtrap user password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=test@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
