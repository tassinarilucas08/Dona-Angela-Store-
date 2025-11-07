import HttpClientBase from "../HttpClientBase.js";

export default class HttpProduct extends HttpClientBase {
  constructor() {
    super("http://localhost/Dona-Angela-Store-/api/Products");
  }

  getAll() {
    return this.get("/");
  }

  getById(id) {
    return this.get(`/id/${id}`);
  }

  add(product) {
    return this.post("/add", product);
  }

  update(product) {
    return this.put("/update", product);
  }

  delete(id) {
    return this.delete(`/delete/id/${id}`);
  }

  updatePhotos(data) {
    return this.post("/photos", data);
  }
}
