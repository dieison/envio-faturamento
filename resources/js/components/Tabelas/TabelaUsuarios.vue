<template>
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">E-mail</th>
          <th scope="col">Tipo</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usuario in usuarios" :key="usuario.id">
          <td class="align-middle">{{usuario.name}}</td>
          <td class="align-middle">{{usuario.email}}</td>
          <td class="align-middle">{{usuario.tipo}}</td>
          <td class="align-middle">
            <a v-bind:href="'usuarios/'+usuario.id+'/edit'">
              <i class="fa fa-pencil-square-o fa-lg link" aria-hidden="true"></i>
            </a>
            <a v-bind:href="'excluir-usuario/'+usuario.id">
              <i class="fa fa-trash fa-lg link" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: ["usuarios"],
};
</script>

<style media="screen">
.link {
  text-decoration: none;
  color: #212529;
}
</style>