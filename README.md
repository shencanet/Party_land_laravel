# Basics
el proyecto esta subido a heroku  [link](https://shencanetretolaravel.herokuapp.com/).




# Endpoints



POST /register :: Registrar usuario

POST /login :: Login a usuario

GET /me  :: ver perfil

GET /logout ::Logout 


### Canales

GET /canales :: ver todos los canales

GET /canales/:id :: ver canal 

GET /canales/juego/:id :: ver canales por juego


POST /canales :: crear canal

PUT /canales/:id :: modificar canal

DELETE /canales/:id :: Borrar canal

### Mensajes

GET /mensajes :: ver todos los mensajes

GET /mensajes/:id :: ver mensaje usuario

POST /mensajes:: crear mensaje

PUT /mensajes/:id :: modificar mensaje

DELETE /mensajes/:id :: borrar mensaje

### juegos

GET /juegos :: Ver todos los juegos

GET /juegos/:id :: ver un juego

POST /juegos :: crear juego

PUT /juegos/:id :: modificar juego

DELETE /juegos/:id :: Borra juego
