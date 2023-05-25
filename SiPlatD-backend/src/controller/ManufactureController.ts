import { AppDataSource } from "../data-source"
import { NextFunction, Request, Response } from "express"
import { Manufacture } from "../entity/Manufacture"

export class ManufactureController {

    private manufactureRepository = AppDataSource.getRepository(Manufacture);

    async all(request: Request, response: Response, next: NextFunction) {
        return this.manufactureRepository.find()
    }

    async one(request: Request, response: Response, next: NextFunction) {
        return this.manufactureRepository.findOneByOrFail({id: request.params.id})
    }

    async save(request: Request, response: Response, next: NextFunction) {
        return this.manufactureRepository.save(request.body)
    }

    async update(request: Request, response: Response, next: NextFunction) {
        await this.manufactureRepository.findOneByOrFail({ id: request.params.id })
        await this.manufactureRepository.update({ id: request.params.id }, request.body)
        return this.manufactureRepository.findOneByOrFail({id: request.params.id})
    }

    async remove(request: Request, response: Response, next: NextFunction) {
        const manufactureToRemove = await this.manufactureRepository.findOneByOrFail({ id: request.params.id })
        return this.manufactureRepository.remove(manufactureToRemove)
    }
}
