import { AppDataSource } from "../data-source"
import { NextFunction, Request, Response } from "express"
import { Category } from "../entity/Category"

export class CategoryController {

    private categoryRepository = AppDataSource.getRepository(Category);

    async all(request: Request, response: Response, next: NextFunction) {
        return this.categoryRepository.find()
    }

    async one(request: Request, response: Response, next: NextFunction) {
        return this.categoryRepository.findOneByOrFail({id: request.params.id})
    }

    async save(request: Request, response: Response, next: NextFunction) {
        return this.categoryRepository.save(request.body)
    }

    async update(request: Request, response: Response, next: NextFunction) {
        await this.categoryRepository.findOneByOrFail({ id: request.params.id })
        await this.categoryRepository.update({ id: request.params.id }, request.body)
        return this.categoryRepository.findOneByOrFail({id: request.params.id})
    }

    async remove(request: Request, response: Response, next: NextFunction) {
        const userToRemove = await this.categoryRepository.findOneByOrFail({ id: request.params.id })
        return this.categoryRepository.remove(userToRemove)
    }
}