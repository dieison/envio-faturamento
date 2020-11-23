<template>
  <div>
    <div class="form-row d-flex justify-content-end">
      <div class="col-md-4">
        <input v-model="searchText" type="text" placeholder="Pesquisar" class="form-control" />
      </div>
      <div class="col-md-2 d-flex justify-content-center">
        <a  v-bind:href="url_relatorio" type="button" class="btn btn-primary">Exportar Tabela</a>
      </div>
    </div>
    <div class="table-responsive mt-2">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Banco</th>
            <th scope="col">Valor</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cliente in pageOfItems" :key="cliente.CodigoCliente">
            <td class="align-middle">{{cliente.Sacado}}</td>
            <td class="align-middle">{{cliente.CNPJCPF_Sacado}}</td>
            <td class="align-middle">{{cliente.NmBco}}</td>
            <td class="align-middle">{{formataNumero(cliente.Valor)}}</td>
            <td class="align-middle">
              <a v-bind:href="'visualizar-cliente/'+cliente.ClienteId">
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
  props: ["clientes","url_relatorio"],
  data() {
    return {
      pageOfItems: [],
      searchText: "",
      customLabels,
    };
  },
  computed: {
    filteredClientes() {
      return this.clientes.filter((cliente) => {
        let textoValid = true;

        if (this.searchText) {
          let searchText = this.searchText.toLowerCase();
          textoValid =
            cliente.Sacado.toLowerCase().includes(searchText) ||
            cliente.CNPJCPF_Sacado.toLowerCase().includes(searchText) ||
            cliente.NmBco.toLowerCase().includes(searchText);
        }
        return textoValid;
      });
    },
  },

  methods: {
    onChangePage(pageOfItems) {
      this.pageOfItems = pageOfItems;
    },

    formataNumero(numero) {
      return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
      }).format(numero);
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