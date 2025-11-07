import HttpPhotoProduct from "../HttpsProduct/HttpPhotoProduct.js";
import { Toast } from "../../Toast.js";

export class PhotoProduct {
  #id;
  #idProduct;
  #photo;

  constructor(id = null, idProduct = null, photo = null) {
    this.#id = id;
    this.#idProduct = idProduct;
    this.#photo = photo;
    this.http = new HttpPhotoProduct();
    this.toast = new Toast();
  }

  getId() { return this.#id; }
  getIdProduct() { return this.#idProduct; }
  getPhoto() { return this.#photo; }

  setId(id) { this.#id = id; }
  setIdProduct(idProduct) { this.#idProduct = idProduct; }
  setPhoto(photo) { this.#photo = photo; }

  async save() {
    if (!this.#idProduct) {
      this.toast.error("Produto não definido para a foto!");
      return null;
    }

    try {
      const formData = new FormData();
      formData.append("idProduct", this.#idProduct);
      formData.append("photo", this.#photo);

      const response = await this.http.add(formData);
      this.toast.success("Foto cadastrada com sucesso!");
      return response;
    } catch (error) {
      this.toast.error(error.message || "Erro ao cadastrar foto do produto");
      return null;
    }
  }

  async delete() {
    if (!this.#id) {
      this.toast.error("Foto não selecionada!");
      return false;
    }

    try {
      await this.http.delete({ id: this.#id });
      this.toast.success("Foto removida com sucesso!");
      return true;
    } catch (error) {
      this.toast.error(error.message || "Erro ao remover foto");
      return false;
    }
  }
}
