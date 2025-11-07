import HttpClientBase from "../HttpClientBase.js";
import { Toast } from "../Toast.js";

export default class HttpProductCategory extends HttpClientBase {
  constructor() {
    super("http://localhost/Dona-Angela-Store-/api/ProductCategories");
    this.toast = new Toast();
  }

  getAll() {
    return this.get("/");
  }

  getById(id) {
    return this.get(`/id/${id}`);
  }

  add(category) {
    return this.post("/add", category)
      .then((res) => {
        this.toast.success("Categoria criada com sucesso!");
        return res;
      })
      .catch((err) => {
        this.toast.error("Erro ao criar categoria.");
        throw err;
      });
  }

  update(category) {
    return this.put("/update", category)
      .then((res) => {
        this.toast.success("Categoria atualizada!");
        return res;
      })
      .catch((err) => {
        this.toast.error("Erro ao atualizar categoria.");
        throw err;
      });
  }

  delete(id) {
    return this.delete(`/delete/id/${id}`)
      .then((res) => {
        this.toast.success("Categoria deletada!");
        return res;
      })
      .catch((err) => {
        this.toast.error("Erro ao deletar categoria.");
        throw err;
      });
  }
}
