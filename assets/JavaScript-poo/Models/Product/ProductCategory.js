import HttpProductCategory from "../HttpsProduct/HttpProductCategory.js";
import { Toast } from "../../Toast.js";

export class ProductCategory {
  #id;
  #idGender;
  #description;

  constructor(id = null, idGender = null, description = null) {
    this.#id = id;
    this.#idGender = idGender;
    this.#description = description;
    this.http = new HttpProductCategory();
    this.toast = new Toast();
  }

  getId() { return this.#id; }
  getIdGender() { return this.#idGender; }
  getDescription() { return this.#description; }

  setId(id) { this.#id = id; }
  setIdGender(idGender) { this.#idGender = idGender; }
  setDescription(description) { this.#description = description; }

  async save() {
    try {
      const data = {
        idGender: this.#idGender,
        description: this.#description
      };

      let response;
      if (this.#id) {
        response = await this.http.update(data);
        this.toast.success("Categoria de produto atualizada com sucesso!");
      } else {
        response = await this.http.add(data);
        this.#id = response.id;
        this.toast.success("Categoria de produto cadastrada com sucesso!");
      }

      return response;
    } catch (error) {
      this.toast.error(error.message || "Erro ao salvar categoria de produto");
      return null;
    }
  }

  async delete() {
    if (!this.#id) {
      this.toast.error("Categoria não selecionada!");
      return false;
    }
    try {
      await this.http.delete({ id: this.#id });
      this.toast.success("Categoria removida com sucesso!");
      return true;
    } catch (error) {
      this.toast.error(error.message || "Erro ao remover categoria");
      return false;
    }
  }
}
