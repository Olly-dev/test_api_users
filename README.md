### Installation
1.importer le projet
     git clone https://github.com/Olly-dev/test_api_users.git
	 
2. allez dans le fichier
		cd test_api_users/

3. installer les dépendances
	composer install


### Requirements
---

- Apache 2.4
- PHP 7.4
- MySQL 5.7
- Composer

### Composants /bundles
---

- Symfony      (composer create-project symfony/skeleton api_users)  
- api-platform (composer require api)
- orm          (composer require orm)
- migrations   (composer require migrations)
- make         (composer require --dev make)

- Bundle league/csv (permet la manipulation des fichier CSV : lecture, écriture et filtrage): composer require league/csv


### Configuration database

1. modifier les paramètres de la base de données à la ligne 32 du fichier .env 
- utilisateur:                  db_user
- mot de passe:                 db_password
- host:port                     127.0.0.1:3306
- nom de la base de données:    db_name

2. création de la base de données avec la commande:
		php bin/console doctrine:database:create

3. création de l'entity member (id, nom, prenom, telephone)
	php bin/console make:entity member

4. versionner les migrations:
		php bin/console make:migration
		
5. exécution des migrations:
	php bin/console doctrine:migrations:migrate
	
6. pour importer les données du fichier CSV dans la base de données, lancez la commande:
		php bin/console csv:import  
		
7. lancez le server local de symfony:
		php -S 127.0.0.1:8000 -t public  
		
### Usage de l'API
---


8. L'api est disponible sur l'url :
		http://127.0.0.1:8000/api

9. la liste des membres adhérants est disponible sur l'url:
		avec l'outil Postman : - url : http://127.0.0.1:8000/api/members
							   - methode : GET
							   
9. la liste des membres adhérants classée par ordre croissant du nom et prenom		   
							  
		avec l'outil Postman : - methode : GET
							   - url pour nom :     http://127.0.0.1:8000/api/members?order[nom]=ASC
							   - url pour prenom :  http://127.0.0.1:8000/api/members?order[prenom]=ASC
							   
							   
10. chaque membre adhérant est disponible sur l'url: http://127.0.0.1:8000/api/members/id
		avec l'outil Postman : - url : http://127.0.0.1:8000/api/members/4
							   - methode : GET
	
### end