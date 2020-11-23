<template>
  <div>
    <ul class="nav justify-content-center menu">
      <li class="nav-item">
        <a class="nav-link link" v-bind:href="url_inicio">
          <i class="fa fa-home mr-2" aria-hidden="true"></i>Início
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link link" v-bind:href="url_clientes">
          <i class="fa fa-users mr-2" aria-hidden="true"></i>Clientes
        </a>
      </li>
      <li v-if="tipo_usuario==1" class="nav-item">
        <a class="nav-link link" v-bind:href="url_usuarios">
          <i class="fa fa-user mr-2" aria-hidden="true"></i>Usuários
        </a>
      </li>
    </ul>
    <hr />
  </div>
</template>

<script>
export default {
  props: ["url_inicio", "url_usuarios","url_clientes","tipo_usuario"]
};
</script>

<style scope>
.link {
  text-decoration: none;
  color: #212529;
}

a:hover {
  color: #212529;
}

.menu {
  font-size: large;
}
</style>