import { MigrationInterface, QueryRunner } from "typeorm"

export class changeInStockToInt1670353585933 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `ALTER TABLE "products" ADD "stock_quantity" INT`
        )
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `ALTER TABLE "products" DELETE "stock_quantity"`
        )
    }

}
