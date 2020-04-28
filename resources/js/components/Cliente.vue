<template>
  <div class="form-row">
    <div class="col-md-4">
      <input-component
        label="Nome"
        :error="inputErrors.nome"
        @change="nome = $event"
        :validation="{required:true}"
        name="nome"
        :edit="editData instanceof Object ? editData.nome : ''"
      />
    </div>
    <div class="col-md-4">
      <input-component
        label="Data de Nascimento"
        :error="inputErrors.data_nascimento"
        @change="data_nascimento = $event"
        :validation="{required:true}"
        type="date"
        :mask="['####-##-##']"
        name="data_nascimento"
        :edit="editData instanceof Object ? editData.data_nascimento.split('T')[0] : ''"
      />
    </div>
    <div class="col-md-4">
      <input-component
        :mask="['#####-###']"
        label="Cep"
        @change="buscarDados"
        type="text"
        :error="inputErrors.cep"
        name="cep"
        :validation="{ required: true, regex: /[0-9]{5}-[\d]{3}/ }"
        :edit="editData instanceof Object ? editData.cep : ''"
      />
    </div>
    <div class="col-md-4 mt-2">
      <input-component
        label="Logradouro"
        :inputChange="logradouro"
        v-model="logradouro"
        :error="inputErrors.logradouro"
        :validation="{required:true}"
        :edit="editData instanceof Object ? editData.logradouro : ''"
        name="logradouro"
      />
    </div>
    <div class="col-md-4 mt-2">
      <input-component
        validation="required"
        label="Complemento"
        type="text"
        :error="inputErrors.complemento"
        :inputChange="complemento"
        :edit="editData instanceof Object ? editData.complemento : ''"
        name="complemento"
      />
    </div>
    <div class="col-md-4 mt-2">
      <input-component
        :mask="['###.###.###-##', '##.###.###/####-##']"
        :validation="{ required: true, regex: /([0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}|[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2})/ }"
        label="Identidade"
        :error="inputErrors.identidade"
        type="text"
        :edit="editData instanceof Object ? editData.identidade : ''"
        name="identidade"
      />
    </div>
    <div class="col-md-4 mt-2">
      <input-component
        :edit="editData instanceof Object ? editData.telefone : ''"
        label="Telefone"
        type="text"
        :error="inputErrors.telefone"
        :mask="['(##) ####-####','(##) #####-####']"
        :validation="{required:true,regex:/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/}"
        name="telefone"
      />
    </div>
  </div>
</template>

<script>
import Input from "./Input";
export default {
  props: ["edit", "erros"],
  data() {
    return {
      nome: "",
      editData: this.edit ? JSON.parse(this.edit) : "",
      logradouro: "",
      cep: "",
      complemento: "",
      identidade: "",
      data_nascimento:"",
      telefone: "",
      inputErrors: {
        nome: [],
        logradouro: [],
        identidade: [],
        telefone: [],
        complemento: [],
        data_nascimento: [],
        cep: []
      }
    };
  },
  mounted() {
    if (this.erros) {
      this.inputErrors.nome = this.erros.hasOwnProperty("nome")
        ? this.erros.nome
        : "";
      this.inputErrors.logradouro = this.erros.hasOwnProperty("logradouro")
        ? this.erros.logradouro
        : "";
      this.inputErrors.identidade = this.erros.hasOwnProperty("identidade")
        ? this.erros.identidade
        : "";
      this.inputErrors.telefone = this.erros.hasOwnProperty("telefone")
        ? this.erros.telefone
        : "";
      this.inputErrors.complemento = this.erros.hasOwnProperty("complemento")
        ? this.erros.complemento
        : "";
      this.inputErrors.cep = this.erros.hasOwnProperty("cep")
        ? this.erros.cep
        : "";

       this.inputErrors.data_nascimento = this.erros.hasOwnProperty("data_nascimento")
        ? this.erros.data_nascimento
        : "";

      
    }
  },
  components: {
    InputComponent: Input
  },
  methods: {
    buscarDados(cep) {
      const cepSemFormatado = cep.split("-").join("");
      fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(res => res.json())
        .then(data => {
          this.logradouro = data.logradouro;
          this.complemento = data.complemento;
        });
    }
  }
};
</script>

<style>
</style>