<template>
  <div>
    <div class="row d-flex justify-content-end">
      <div class="col-4">
        <input v-model="searchText" type="text" placeholder="Pesquisar" class="form-control" />
      </div>
    </div>
    <div class="table-responsive mt-2">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nome Fantasia</th>
            <th scope="col">Razão Social</th>
            <th scope="col">Segmentação</th>
            <th scope="col">CNPJ</th>
            <th scope="col">E-mail</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cliente in pageOfItems" :key="cliente.CodigoCliente">
            <td class="align-middle">{{cliente.NomeFantasia}}</td>
            <td class="align-middle">{{cliente.RazaoSocial}}</td>
            <td class="align-middle">{{cliente.TipoCliente}}</td>
            <td class="align-middle">{{cliente.CNPJCPF}}</td>
            <td class="align-middle">{{cliente.Email}}</td>
            <td class="align-middle">
              <a v-bind:href="'visualizar-cliente/'+cliente.CodigoCliente">
                <i class="fa fa-eye fa-lg link" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row card-footer">
      <jw-pagination
        :items="filteredClientes"
        @changePage="onChangePage"
        :labels="customLabels"
        :pageSize="15"
        :maxPages="18"
      ></jw-pagination>
    </div>
  </div>
</template>
<script>
const customLabels = {
  first: "Primeira",
  last: "Última",
  previous: "Anterior",
  next: "Próxima",
};
export default {
  data() {
    return {
      pageOfItems: [],
      searchText: "",
      customLabels,
      clientes:[]
    };
  },

  mounted(){
    this.getClientes();
  },

  computed: {
    filteredClientes() {
      return this.clientes.filter((cliente) => {
        let textoValid = true;

        if (this.searchText) {
          let searchText = this.searchText.toLowerCase();
          textoValid =
            cliente.NomeFantasia.toLowerCase().includes(searchText) ||
            cliente.CNPJCPF.toLowerCase().includes(searchText);
        }
        return textoValid;
      });
    },
  },

  methods: {
    getClientes() {
      this.$vs.loading();
      axios
        .get("/api/get-clientes")
        .then((response) => {
          this.clientes = response.data;
          this.$vs.loading.close();
        })
        .catch((e) => {
          this.$vs.loading.close();
        });
    },

    onChangePage(pageOfItems) {
      this.pageOfItems = pageOfItems;
    },
  },
};
</script>

<style media="screen">
.link {
  text-decoration: none;
  color: #212529;
}
</style>