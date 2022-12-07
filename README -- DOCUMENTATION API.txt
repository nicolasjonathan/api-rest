0)  Préface :

    Avant toute chose, veillez à insérer des identifiants de connexions correctes
    pour la connexion à la base de donnée dans le fichier "Database.php".

    Uploadez ensuite la base de donnée ( le fichier sql "apirest.sql") située à la racine du répertoire dans votre SGBD.
    
    NB: LLe contenu du fichier .htaccess situé à la racine de ce répertoire permet de modifier l'url de façon à ce qu'il soit plus lisible pour le client.


1) Récupérer des informations sur un ou plusieurs magasins (GET) :

    Pour obtenir la liste de tous les magasins enregistrés et leurs informations : 
    Exemple: http://votre-site.com/magasins/
    
    Obtenir la liste de toutes les catégories de magasins enregistrés et leurs informations.
    Exemple 1 : http://votre-site.com/categories/
    Exemple 2 : http://votre-site.com/magasins/id/ 
    
    
    Avoir les informations d' un magasin à partir de son ID (remplacer l'ID par le numéro de votre choix).

    Exemple 1 :  obtenir l'ensemble des informations du magasin n°8: 
    http://votre-site.com/magasins/8/
    
    Example 2 :  obtenir l'ensemble des informations de la catégorie de magasin n°8:
    http://votre-site.com/categories/8/


    Obtenir un attribut ou détail particulier concernant le magasin dont l'id est 7 ou la catégorie de magasin dont l'id est 7 : 

    Obtenir le NOM du septième magasin : http://votre-site.com/magasins/7/nom/
    Obtenir la CATÉGORIE du septième magasin : http://votre-site.com/magasins/7/categorie/
    Obtenir la DESCRIPTION du septième magasin : http://votre-site.com/magasin/7/description/
    

2) Ajouter un magasin (POST):

    Via une reqête POST, il vous est possible d'ajouter un magasin ou une catégorie de magasin à l'API. Il suffit pour cela d'envoyer un objet JSON. 
    
    Exemple : ajouter le magasin "Petit Bateau" via une requête POST :

    {
        "nom" : "Petit Bateau", 
        "description" : "Magasin de pret à porter pour petits et grands, inspiré des vêtements marins.",
        "categories_id" : 5,
        "logo" : "petitbateau.png"
    }



3) Éditer un magasin (PUT):

    Via une requête de type PUT, vous pourrez également éditer un magasin ou une catégorie. 
    Pour cela, il vous suffit d'envoyer un tableau comprenant deux objets JSON :
    
    Le premier contiendra les mises à jour à effectuer, le second l' ID du magasin/catégorie à mettre à jour.

    Exemple : modifier le nom et la description de l'enseigne Petit Bateau via une requête PUT :
    
    [{"nom": "Petit Bateau", "description" : "magasin de pret à porter mixte" },{"id":32}]



4) Supprimer un magasin ou une catégorie (DELETE):

    Pour supprimer une entrée, il vous suffira simplement d'envoyer au format JSON l'id du magasin ou de la catégorie
    que vous souhaitez supprimer via une requete de type DELETE.

    Exemple, supprimer le magasin n° 31 de l'API, via une requête DELETE: 
    31
