// classes/HttpsUser/HttpProduct.js
import HttpClientBase from "../HttpClientBase.js";

export class HttpProduct extends HttpClientBase {
    constructor() {
        super("http://localhost/Dona-Angela-Store-/api/Products");
    }

    async create(data) {
        return this.post("/createProduct", data);
    }

    async update(data) {
        return this.put("/update", data);
    }

    async uploadPhotos(formData) {
        return this.post("/updatePhotos", formData);
    }

    async getAll() {
        return this.get("/listProducts");
    }

    async getById(id) {
        return this.get(`/listProductById/${id}`);
    }

    async delete(id) {
        return this.post("/deleteProduct", { id });
    }
}
