// classes/Users/HttpsUser/HttpUser.js
import HttpClientBase from "../HttpClientBase.js";

export class HttpUser extends HttpClientBase {
    constructor() {
        // URL base para o backend
        super("http://localhost/Dona-Angela-Store-/api/Users");
    }

    async loginUser(data) {
        return this.post("/login", data);
    }

    async createUser(data) {
        return this.post("/add", data);
    }

    async updateUser(data) {
        return this.put("/update", data);
    }

    async deleteUser(id) {
        return this.delete(`/delete/id/${id}`);
    }

    async listUsers() {
        return this.get("/");
    }

    async listUserById(id) {
        return this.get(`/id/${id}`);
    }
}
