# Online Book Reading
## Technologies Used
- Framework: Laravel
- Styling: CSS, Tailwind
## System Functionality
This book reading system can be accessed by three types of users: unregistered, registered, and administrators. Using Authentication gates, low cleareance users cannot visit high clearance views. For exmple, an unregistered user will be redirected if they try to access an admin view.
### Unregistered Users
- Can register as reader
- Can view the homepage
- Can read all books
- Can search for books by title
- Cannot save books
### Registered Users
- Can log in or out
- Can browse and read books
- Can search for books by title
- Can save books for later viewing
- Can manage saved books (view, delete)
- Can update their profile (update, delete account)
### Admin Users
- Can log in or out
- Can access the admin panel
- Can create, update, and delete books
- Can add, update, and delete book chapters
## Database Structure
The system uses a relational database to store books, users, and saved book entries.
- Books Table: Stores book details
- Chapters Table: Stores individual book chapters
- Users Table: Stores user authentication and profile information
- Saved Books Table: Maintains user-saved books with relationships to users and books
![database](https://github.com/user-attachments/assets/f0840834-68eb-4778-a266-e92931aa6ccf)
## Use Case Diagram
The diagram below represents the actions of a user after logging into their account.
![usecase](https://github.com/user-attachments/assets/9fbb3aeb-a244-437a-84d2-f19aa4eb3673)

