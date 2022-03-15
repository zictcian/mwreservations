<template>
<div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <nav class="navbar navbar-expand navbar-light">
      <a href="/"><img src="../assets/logoReservations.png" alt="" width="100px"></a>
      <div class=""><input class="typeahead form-control" type="text" placeholder="Search place"></div>
      <button class="btn"><i class="fa fa-search"></i></button>
      <div class="container">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="/inicio" class="nav-link"><i class="bi bi-house-fill colore"></i></a>
            </li>
            <li class="nav-item">
              <a href="/fav" class="nav-link"><i class="bi bi-heart-fill colore"></i>Favoritos</a>
            </li>
            <li class="nav-item">
              <a href="/categorias" class="nav-link">Categorias</a>
            </li>
            <li class="nav-item">
              <a href="/conocenos" class="nav-link">Conocenos</a>
            </li>
            <li class="nav-item">
              <a href="/login" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
              <a href="/carrito" class="nav-link"><i class="bi bi-cart colore"></i></a>
            </li>
            <li class="nav-item">
              <a href="/usuario" class="nav-link"><i class="bi bi-person-circle colore"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    </div>
</template>

<script>
export default {
  name: 'NavMW'
}
</script>

<style scoped>

.typeahead{
  margin-left: 10%;
  width: 100%;
  border-bottom-right-radius: 0%;
}
.btn {
  background-color: orange; /* Blue background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 8px 12px; /* Some padding */
  font-size: 14px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
  border-radius: 30%;
}
.btn:hover {
  background-color: green;
}
.nav-item:hover{
  color: blue;
  background-color: lightgray;
  text-decoration: underline;
}
.colore:hover{
  color: red;
}
</style>
