## About This Package

<p>
This package handles operations provided in CSV format and calculates a commission fee based on defined rules.
You can upload CSV files, use static sample data that are hard code, or a data generator for the test.
This package was created by <strong>Laravel version 8.0</strong>
</P>
also, you can define manually

<ul>
<li>Free withdraw limit</li> 
<li>Free withdraw amount limit </li>
<li>Percentage of Deposit Charge </li>
<li>Percentage of withdraw commission for business clients</li>
<li>Percentage of withdraw commission for private clients</li>
</ul>

## Roles

By default 

<ul>
<li>Free withdraw limit = 3</li> 
<li>Free withdraw amount limit = 1000€</li>
<li>Percentage of Deposit Charge = 0.03%</li>
<li>Percentage of withdraw commission for business clients = 0.5</li>
<li>Percentage of withdraw commission for private clients = 0.3</li>
</ul>

<strong>Describe the roles</strong>

<ul>
<li>Commission fee - 0.3% from withdrawn amount for private clients.</li>
1000.00 EUR for a week (from Monday to Sunday) is free of charge. Only for the first 3 withdraw operations per a week. 4th and the following operations are calculated by using the rule above (0.3%). If total free of charge amount is exceeded them commission is calculated only for the exceeded amount (i.e. up to 1000.00 EUR no commission fee is applied).
</li>
<li>Commission fee - 0.5% from withdrawn amount for business clients. Business clients don't have a free commission</li>
<li>All deposits are charged 0.03% of deposit amount.</li>
</ul>

## Input Data

<p>
If you want to upload CSV files your data must be included with these fields
</p>

<ol dir="auto">
<li>operation date in format <code>Y-m-d</code></li>
<li>user's identificator, number</li>
<li>user's type, one of <code>private</code> or <code>business</code></li>
<li>operation type, one of <code>deposit</code> or <code>withdraw</code></li>
<li>operation amount (for example <code>2.12</code> or <code>3</code>)</li>
<li>operation currency, one of <code>EUR</code>, <code>USD</code>, <code>JPY</code></li>
</ol>

## Export Data

You can export results as HTML, PDF or Excel Files
Export data as PDF file maybe need time, please check this feature for a maximum of 1000 data
## Run Locally

After pull codes'
in project folder

composer install
composer dump-autoload
php artisan serve

## Unit Testing

php artisan test

### Live Demo

<p><a href="https://commission.fiachehr.ir/sampleData.csv">Sample CSV File</a></p>
<p><a href="https://commission.fiachehr.ir">LIVE DEMO</a></p>

