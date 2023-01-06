race-api
==================

An example of importing a CSV into two entities, one related to the other, using
a Symfony 3 console command and Race CSV.

``` language-bash
➜  race-api php bin/console doctrine:schema:update --force
Updating database schema...
Database schema updated successfully! "3" queries were executed

➜  race-api php bin/console csv:import                      

Attempting import of Feed...
============================

 1000/1000 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

                                                                                                                        
 [OK] Command exited cleanly!                                                                                           
                                                                                                                        

```