import { AppDataSource } from "../data-source"
import { NextFunction, Request, Response } from "express"
import { Report } from "../entity/Report"

export class ReportController {

    private transactionRepository = AppDataSource.getRepository(Report);

    async all(request: Request, response: Response, next: NextFunction) {
        return this.transactionRepository.find()
    }

    async one(request: Request, response: Response, next: NextFunction) {
        return this.transactionRepository.findOneByOrFail({id: request.params.id})
    }

    async save(request: Request, response: Response, next: NextFunction) {
        return this.transactionRepository.save(request.body)
    }

    async update(request: Request, response: Response, next: NextFunction) {
        await this.transactionRepository.findOneByOrFail({ id: request.params.id })
        await this.transactionRepository.update({ id: request.params.id }, request.body)
        return this.transactionRepository.findOneByOrFail({id: request.params.id})
    }

    async remove(request: Request, response: Response, next: NextFunction) {
        const transactionToRemove = await this.transactionRepository.findOneByOrFail({ id: request.params.id })
        return this.transactionRepository.remove(transactionToRemove)
    }
}
