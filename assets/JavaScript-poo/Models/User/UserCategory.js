import { HttpUserCategory } from "../HttpsUser/HttpUserCategory.js";
import { Toast } from "../../Toast.js";

export class UserCategory {
    #id;
    #description;

    constructor(id = null, description = null) {
        this.#id = id;
        this.#description = description;

        this.http = new HttpUserCategory(); // Instancia o HttpUserCategory
        this.toast = new Toast();           // Instancia o Toast
    }

    // Getters e Setters
    getId() { return this.#id; }
    getDescription() { return this.#description; }

    setId(id) { this.#id = id; }
    setDescription(description) { this.#description = description; }

    // CRUD
    async save() {
        if (!this.#description) {
            this.toast.error("Descrição é obrigatória!");
            return false;
        }

        try {
            const data = await this.http.create({ description: this.#description });

            if (!data || !data.data) {
                this.toast.error(data.message || "Erro ao cadastrar categoria de usuário.");
                return false;
            }

            this.toast.success("Categoria de usuário cadastrada!");
            this.#id = data.data.id;
            return true;

        } catch (error) {
            console.error("Erro ao cadastrar categoria:", error);
            this.toast.error("Erro no servidor. Tente novamente mais tarde.");
            return false;
        }
    }

    async listAll() {
        try {
            const data = await this.http.getAll();
            return data?.data || [];
        } catch (error) {
            console.error("Erro ao listar categorias:", error);
            this.toast.error("Erro ao listar categorias.");
            return [];
        }
    }

    async findById(id) {
        try {
            const data = await this.http.getById(id);
            if (data?.data) {
                this.#id = data.data.id;
                this.#description = data.data.description;
                return true;
            }
            return false;
        } catch (error) {
            console.error("Erro ao buscar categoria:", error);
            return false;
        }
    }
}
