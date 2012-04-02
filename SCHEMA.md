#Schema

* Users
	* id INT
	* username VARCHAR 50
	* password VARCHAR 255
	* email VARCHAR 255
	* last_login VARCHAR 25
	* login_hash VARCHAR 255
	* profile_fields TEXT

php oil g admin users username:varchar[50] password:string email:string last_login:int login_hash:string profile_fields:text

* Users_Permissions
	* id INT
	* user_id INT
	* type ENUM(Company, Project, Task)
	* type_id INT
	* permissions TEXT

php oil g admin users_permissions type:enum[Company,Project,Task] task_id:int permissions:text user_id:int

* Companies
	* id INT
	* name VARCHAR 255
	* address VARCHAR 255
	* city VARCHAR 50
	* state VARCHAR 50
	* zip VARCHAR 10

php oil g admin companies name:string address:string city:varchar[50] state:varchar[50] zip:varchar[50]

* Projects
	* id INT
	* company_id INT
	* name VARCHAR 255
	* description TEXT

php oil g admin projects name:string description:text company_id:int

* Tasks
	* id INT
	* project_id INT
	* name VARCHAR 255
	* description TEXT
	* blocks INT
	* sort INT
	* status ENUM(Not Started, Being Worked On, Awaiting Approval, Approved)
	
php oil g admin tasks name:string description:text blocks:int sort:int status:enum[NotStarted,InProgress,AwaitingApproval,Approved] project_id:int