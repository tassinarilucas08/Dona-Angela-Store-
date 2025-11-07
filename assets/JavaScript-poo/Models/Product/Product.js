import HttpProduct from "../HttpsProduct/HttpProduct.js";
import { Toast } from "../../Toast.js";

export class Product {
  #id;
  #idCategory;
  #idBrand;
  #name;
  #price;
  #salePrice;
  #description;
  #photo;
  #quantity;
  #idStatus;

  constructor(
    id = null,
    idCategory = null,
    idBrand = null,
    name = null,
    price = null,
    salePrice = null,
    description = null,
    photo = null,
    quantity = null,
    idStatus = null
  ) {
    this.#id = id;
    this.#idCategory = idCategory;
    this.#idBrand = idBrand;
    this.#name = name;
    this.#price = price;
    this.#salePrice = salePrice;
    this.#description = description;
    this.#photo = photo;
    this.#quantity = quantity;
    this.#idStatus = idStatus;
    this.http = new HttpProduct();
    this.toast = new Toast();
  }

  getId() { return this.#id; }
  getIdCategory() { return this.#idCategory; }
  getIdBrand() { return this.#idBrand; }
  getName() { return this.#name; }
  getPrice() { return this.#price; }
  getSalePrice() { return this.#salePrice; }
  getDescription() { return this.#description; }
  getPhoto() { return this.#photo; }
  getQuantity() { return this.#quantity; }
  getIdStatus() { return this.#idStatus; }

  setId(id) { this.#id = id; }
  setIdCategory(idCategory) { this.#idCategory = idCategory; }
  setIdBrand(idBrand) { this.#idBrand = idBrand; }
  setName(name) { this.#name = name; }
  setPrice(price) { this.#price = price; }
  setSalePrice(salePrice) { this.#salePrice = salePrice; }
  setDescription(description) { this.#description = description; }
  setPhoto(photo) { this.#photo = photo; }
  setQuantity(quantity) { this.#quantity = quantity; }
  setIdStatus(idStatus) { this.#idStatus = idStatus; }

  async save() {
    try {
      const data = {
        idCategory: this.#idCategory,
        idBrand: this.#idBrand,
        name: this.#name,
        price: this.#price,
        salePrice: this.#salePrice,
        description: this.#description,
        photo: this.#photo,
        quantity: this.#quantity,
        idStatus: this.#idStatus
      };

      let response;
      if (this.#id) {
        response = await this.http.update(data);
        this.toast.success("Produto atualizado com sucesso!");
      } else {
        response = await this.http.add(data);
        this.#id = response.id; // assume o retorno com id do produto
        this.toast.success("Produto cadastrado com sucesso!");
      }
      return response;
    } catch (error) {
      this.toast.error(error.message || "Erro ao salvar produto");
      return null;
    }
  }

  async delete() {
    if (!this.#id) {
      this.toast.error("Produto não selecionado!");
      return false;
    }
    try {
      await this.http.delete({ id: this.#id });
      this.toast.success("Produto removido com sucesso!");
      return true;
    } catch (error) {
      this.toast.error(error.message || "Erro ao remover produto");
      return false;
    }
  }

  async fetchById(id) {
    try {
      const data = await this.http.getById(id);
      Object.assign(this, data);
      return true;
    } catch (error) {
      this.toast.error(error.message || "Produto não encontrado");
      return false;
    }
  }
}
