0)  Introduction à la documentation :

    Avant toute chose, veillez à insérer des identifiants de connexions correctes
    afin de se connecter à la base de donnée du fichier Database.php.

    Uploadez ensuite la base de donnée sql située à la racine du dossier (apirest.sql).


1) Récupérer des informations sur un ou plusieurs magasins (GET) :

    Obtenir la liste de tous les magasins enregistrés et leurs informations.
    http://localhost:8888/magasins/
    Obtenir la liste de toutes les catégories de magasins enregistrés et leurs informations.
    http://localhost:8888/categories/

    http://localhost:8888/magasins/id/ 
    Avoir les informations d' un magasin à partir de son ID (remplacer l'ID par le numéro de votre choix).

    Example :  obtenir l'ensemble des informations du magasin n°8: 
    http://localhost:8888/magasins/8/
    Example :  obtenir l'ensemble des informations de la catégorie de magasin 8:
    http://localhost:8888/categories/8/


    Obtenir un attribut particulier du magasin ou de la catégorie de magasin désiré : 

    Example, avec les magasins et catégories n°8 :
    http://localhost:8888/magasins/8/nom/
    http://localhost:8888/magasins/8/categorie/
    http://localhost:8888/magasin/8/description/

    http://localhost:8888/catégories/8/nom/




2) Ajouter un magasin (POST):

    Via une reqête POST, il vous est possible d'ajouter un magasin ou une catégorie à l'API. Il suffit pour cela d'envoyer un objet JSON. 
    Exemple : ajouter le magasin "Petit Bateau" :

    {
        "nom" : "Petit Bateau", 
        "description" : "Magasin de pret à porter pour petits et grands, inspiré des vêtements marins.",
        "categories_id" : 5,
        "logo" : "petitbateau.png"
    }




3) Éditer un magasin (PUT):

    Via une requête de type PUT, vous pourrez également éditer un magasin ou une catégorie. 
    Pour cela, il vous suffit d'envoyer un tableaux de deux objets JSON, 
    l'un contenant les mises à jour à effectuer, le second l' iD du magasin/catégorie à mettre à jour.

    Exemple : modifier le nom et la description de l'enseigne Petit Bateau : 
    [{"nom": "Petit Bateau", "description" : "magasin de pret à porter mixte" },{"id":32}]



4) Supprimer un magasin ou catégorie (DELETE):

    Il vous suffit d'envoyer au format JSON l'id du magasin que vous souhaitez supprimer via une requete de type DELETE.

    Exemple, supprimer le magasin n° 1 : 
    31



5) contenu du .htaccess situé dans à la racine de ce dossier, au cas ou celui choix serait manquant:

RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php?req=$1
