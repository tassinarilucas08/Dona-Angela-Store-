import HttpClientBase from "../HttpClientBase.js";
import { Toast } from "../Toast.js";

export default class HttpPhotoProduct extends HttpClientBase {
  constructor() {
    super("http://localhost/Dona-Angela-Store-/api/Products");
    this.toast = new Toast();
  }

  add(photoProduct) {
    const formData = new FormData();
    formData.append("idProduct", photoProduct.getIdProduct());
    formData.append("photo", photoProduct.getPhoto());

    return this.post("/photos", formData)
      .then((res) => {
        this.toast.success("Foto adicionada!");
        return res;
      })
      .catch((err) => {
        this.toast.error("Erro ao adicionar foto.");
        throw err;
      });
  }

  update(photoProduct) {
    // Caso precise de update específico
    return this.add(photoProduct);
  }

  delete(id) {
    return this.delete(`/photos/delete/id/${id}`)
      .then((res) => {
        this.toast.success("Foto deletada!");
        return res;
      })
      .catch((err) => {
        this.toast.error("Erro ao deletar foto.");
        throw err;
      });
  }
}
