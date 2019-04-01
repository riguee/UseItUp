--- Use It Up ---

--- Setting up the database ---
    Please follow the instructions on this ReadMe file to install and use the UseItUp app.
    Firstly, run the SQL code attached in your local host. This will create the database and populate it with dummy data. It will also create a user account with privileges on the UseItUp database. Additionally, as our app functions on a day-to-day basis (listings are only available on the day they are posted, otherwise they expire and are not visible anymore), the SQL code will also update all the listings and set their date to be on the day when you create the database.
    If you don't see any dummy data while using the application, it will probably be because all the listings have expired. Running this simple SQL query will update them and set their date to the current date: UPDATE `listings` SET `day_posted` = CURDATE().

--- Using the app ---
    First, please login as a restaurant and upload a food listing. You can either register a new account, or log into an existing account using the credentials below. After creating a listing, you will see that the listing appears in the my account page, from which you can edit the restaurant's information. To change the restaurant's available pickup times, there needs to be no upcoming order and no available listing on the restaurant's account. On the orders page, you can see whether the listing you have uploaded has been ordered by a charity.
    Then, please login as a charity. You will observe that the listing you have created as a restaurant appears on the main search page. You can order listings from a restaurant and see the order appear in the orders tab. If the order is deleted, the listings will reappear on the main search page.
    Please, login as a restaurant again, and you will observe that the listings that have just been ordered will appear in the orders tab.
    

--- User accounts ---
    -Restaurant-
username: banana@land.com
password: Useitup123

     -Charity-
username: info@foodforgood.com
password: Useitup123
