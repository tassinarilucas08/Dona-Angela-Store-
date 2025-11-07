import HttpClientBase from "../HttpClientBase.js";

export class HttpUser extends HttpClientBase {
    constructor() {
        // URL base para todas as requisições de Users
        super("http://localhost/Dona-Angela-Store-/api/Users");
    }

    // Login do usuário
    async login(data) {
        return this.post("/login", data);
    }

    // Criar usuário
    async createUser(data) {
        return this.post("/add", data);
    }

    // Registrar usuário pendente (não obrigatório, mas existe no index)
    async registerPending(data) {
        return this.post("/registerPending", data);
    }

    // Confirmar email
    async confirmEmail(token) {
        return this.get(`/confirm/${token}`);
    }

    // Atualizar usuário
    async updateUser(data) {
        return this.put("/update", data);
    }

    // Atualizar senha
    async updatePassword(data) {
        return this.put("/updatePass", data);
    }

    // Enviar email para reset de senha
    async sendResetPasswordEmail(data) {
        return this.post("/sendEmail", data);
    }

    // Deletar usuário por ID
    async deleteUser(id) {
        return this.delete(`/delete/id/${id}`);
    }

    // Atualizar foto
    async updatePhoto(formData) {
        return this.post("/photo", formData);
    }

    // Atualizar arquivo
    async updateFile(formData) {
        return this.post("/file", formData);
    }

    // Listar todos os usuários
    async listUsers() {
        return this.get("/");
    }

    // Listar usuário por ID
    async listUserById(id) {
        return this.get(`/id/${id}`);
    }

    // Limpar registros pendentes (ex: cadastros expirados)
    async clearExpiredPendings() {
        return this.delete("/clearPendings");
    }
}
