READ ME

Ovo je jednostavni webshop napravljen sa Symfony frameworkom.
Kako bi pokrenili server koristi se komanda 

- symfony server:start

Za setup baze potrebno je u .env promjeniti parametar 

- DATABASE_URL="mysql://my_user:my_password@127.0.0.1:3306/my_database"

Pripremljene su migracije za lako kreiranje baze, za pokretanje migracija koristi se komanda

- php bin/console doctrine:migrations:migrate

Iako su testovi opcionalni u ovom zadatku napisao sam jedan test forme radi.
Testovi se pokrecu sa komandom

- php vendor\bin\phpunit

U public folderu se nalazi postmen kolekcija te dijagram baze




### komentar developera ###

dosta toga bi se jos moglo napraviti ali kao ogledni primjera mislim kako nema potrebe,
za ovaj primjer smatram kako nema potrebe korsititi DDD arhitekturu iako u vecim projektima definitivno smatram kako je potrebna