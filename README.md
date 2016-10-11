# LibrarySystem
LibrarySystem

# Steps to create and initialize the database:
1. Create the instance of the MySQL database with the name of: ‘librarysystem’
2. Then Import the ‘librarysystem.sql’ file which is resided inside the ‘trunk\db’ directory.
3. If you want to change the database’s user credentials, which you can set/change at the following file: ‘trunk\application\config -> database.php’ [@LOC:79 & @LOC:80]


#Steps to prepare the source code to build/run properly:
1. Copy the ‘LibrarySystem.git’ directory into the WAMP/XAMP’s www/htaccess directory.
2. Make sure the ‘mod_rewrite’ is enabled because CodeIgniter without this module can’t work.
Note: My assumption is that the WAMP/XAMP server is installed and MySQL database is up and localhost is ready to use.

#Admin Credential:
Username: admin
Password: admin

#	Authenticated User Credential:
Username: user1
Password: user1

# LibrarySystem's Functional Specifications:

Admin Panel:

1. Only the user with admin role can login to admin panel and can perform the following actions:
  a. Manage the racks (rack name)
  b. Manage the books and add them in their specific racks. (book title, author, published year)
  c. Only 10 books can be added in a rack. An alert should prompt if admin is trying to add more books.
  
Client Panel:

1. Any registered user can login and perform following actions:
1.1. Racks: See the list of all racks and total books in them. Click on any rack to see the added book details
1.2. Books:
  1.2.1 Search the books with title, author name or published year.
  1.2.2 The result should show the book details along with the rack name

#Current Status:
Completed.
