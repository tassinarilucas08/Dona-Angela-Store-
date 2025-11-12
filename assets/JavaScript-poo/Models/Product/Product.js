// classes/Products/Product.js
import { HttpProduct } from "../../HttpsUser/HttpProduct.js";
import { Toast } from "../../Toast.js";

export class Product {
    #id;
    #idCategory;
    #idBrand;
    #name;
    #price;
    #salePrice;
    #description;
    #quantity;
    #idStatus;
    #photos;

    constructor(
        id = null,
        idCategory = null,
        idBrand = null,
        name = "",
        price = 0,
        salePrice = 0,
        description = "",
        quantity = 0,
        idStatus = 1,
        photos = []
    ) {
        this.#id = id;
        this.#idCategory = idCategory;
        this.#idBrand = idBrand;
        this.#name = name;
        this.#price = price;
        this.#salePrice = salePrice;
        this.#description = description;
        this.#quantity = quantity;
        this.#idStatus = idStatus;
        this.#photos = photos;

        this.http = new HttpProduct();
        this.toast = new Toast();
    }

    // ===== CRUD =====

    async save() {
        try {
            const response = await this.http.create({
                idCategory: this.#idCategory,
                idBrand: this.#idBrand,
                name: this.#name,
                price: this.#price,
                salePrice: this.#salePrice,
                description: this.#description,
                quantity: this.#quantity,
                idStatus: this.#idStatus,
            });

            if (response?.type === "success") {
                this.toast.success(response.message);
                this.#id = response.data?.id ?? null;
                return true;
            } else {
                this.toast.error(response?.message || "Erro ao cadastrar produto.");
                return false;
            }
        } catch (error) {
            console.error("Erro ao cadastrar produto:", error);
            this.toast.error("Erro no servidor.");
            return false;
        }
    }

    async update() {
        try {
            const response = await this.http.update({
                id: this.#id,
                idCategory: this.#idCategory,
                idBrand: this.#idBrand,
                name: this.#name,
                price: this.#price,
                salePrice: this.#salePrice,
                description: this.#description,
                quantity: this.#quantity,
                idStatus: this.#idStatus,
            });

            if (response?.type === "success") {
                this.toast.success(response.message);
                return true;
            } else {
                this.toast.error(response?.message || "Erro ao atualizar produto.");
                return false;
            }
        } catch (error) {
            console.error("Erro ao atualizar produto:", error);
            this.toast.error("Erro no servidor.");
            return false;
        }
    }

    async listAll() {
        try {
            const response = await this.http.getAll();
            return response?.data || [];
        } catch (error) {
            console.error("Erro ao listar produtos:", error);
            this.toast.error("Erro ao listar produtos.");
            return [];
        }
    }

    async findById(id) {
        try {
            const response = await this.http.getById(id);

            if (response?.data) {
                Object.assign(this, response.data);
                return true;
            } else {
                this.toast.error(response?.message || "Produto não encontrado.");
                return false;
            }
        } catch (error) {
            console.error("Erro ao buscar produto:", error);
            this.toast.error("Erro ao buscar produto.");
            return false;
        }
    }

    async uploadPhotos(files) {
        if (!this.#id) {
            this.toast.error("Salve o produto antes de enviar fotos.");
            return false;
        }

        const formData = new FormData();
        formData.append("id", this.#id);
        for (const file of files) {
            formData.append("photos[]", file);
        }

        try {
            const response = await this.http.uploadPhotos(formData);

            if (response?.type === "success") {
                this.toast.success(response.message);
                this.#photos = response.data?.photos || [];
                return true;
            } else {
                this.toast.error(response?.message || "Erro ao enviar fotos.");
                return false;
            }
        } catch (error) {
            console.error("Erro ao enviar fotos:", error);
            this.toast.error("Erro no servidor.");
            return false;
        }
    }

    async delete() {
        try {
            const response = await this.http.delete(this.#id);

            if (response?.type === "success") {
                this.toast.success(response.message);
                return true;
            } else {
                this.toast.error(response?.message || "Erro ao excluir produto.");
                return false;
            }
        } catch (error) {
            console.error("Erro ao excluir produto:", error);
            this.toast.error("Erro no servidor.");
            return false;
        }
    }
}