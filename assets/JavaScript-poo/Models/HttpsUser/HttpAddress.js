import HttpClientBase from "../../HttpClientBase.js";

export class HttpAddress extends HttpClientBase {
    constructor() {
        super("http://localhost/Dona-Angela-Store-/api/Addresses");
    }

    async create(data) {
        return this.post("/add", data);
    }

    async getAll() {
        return this.get("/");
    }

    async getAllByUser(userId) {
        return this.get("/", { userId });
    }

    async getById(id) {
        return this.get(`/id/${id}`);
    }

    async update(data) {
        return this.put("/update", data);
    }

    async delete(id) {
        return this.delete(`/delete/id/${id}`);
    }
}
