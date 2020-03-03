This blog api is generated using Laravel framework. This is a multiple role blog system (backend only). A normal user can CRUD his own posts, a manager can CRUD all posts, and an admin can CRUD all posts and users. 

Normal user role id =0;
Manager role id = 1;
Admin role id =2;


# Routes

## Auth [public]

- Login :/api/login [post] 
- Register :/api/register [post] 

## Users [token required] [only admin]

- Add new user: /api/users [post] 
- Get all users: /api/users [get] 
- Get a user: /api/users/id [get] 
- Update a user: /api/users/id [put] 
- Delete a user: /api/users/id [delete] 

## Posts [token required] [normal user(own posts)/ manager / admin]

- Add new post: /api/posts [post] 
- Get all posts: /api/posts [get] 
- Get a post: /api/posts/id [get] 
- Update a post: /api/posts/id [put] 
- Delete a post: /api/posts/id [delete] 



