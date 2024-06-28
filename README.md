# Sport Leagues - Web Application

The fourth Sprint of the PHP Full Stack Web Development Boot-camp at IT Academy Barcelona was to create a dynamic web application containing at least 2 CRUDs (Create, Read, Update, Delete) with the goal of managing a football league (Teams and Matches).

I chose to create a web application in order to manage leagues of any sport (actual version is limited to Volley and Basketball).
This application has the following CRUDs:

1. CRUD for Leagues selecting an available sport
2. CRUD for Teams
3. CRUD for Matches
4. CRUD for Players

Nonetheless by miss of time it is still a work in progress.

Some things that MUST be improved or added are:
1. Code refactoring
2. Code cleaning
3. Design Improvement
4. Increase Sport Possibilites
5. Add Users Authorization
6. Add Location By a Maps Service
7. Easy League Creation
8. Etc.



# Build Project


Once Cloned the repository remember to:

```
	1. Add composer dependencies:
		composer install
	
	2. Add nmp dependencies:
		npm install
		
	3. Create de .env file with the database configuration
		
	4. Create the link in order to be able to add files [IMPORTANT]
		(In the root folder of the project)
		(Tested Under Linux System)
		ln -rs ./storage/app/  ./public/storage
	
	5. Run nmp:
		npm run dev
	
	6. Run Artisan Serve:
		php artisan serve
		
	*If running old database version images are not stored in cloned repository...
	** Better to start a new table, images should be stored in different folders depending on the use of them.
	
	7. Search as many errors, improvement or whatever as possible. 
	Any feedback will be welcome!! :D
	
```



		
	
		












