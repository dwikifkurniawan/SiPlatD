import { MigrationInterface, QueryRunner } from "typeorm"

export class addQuantityToMaterialsTable1670354108696 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `ALTER TABLE "products" DROP COLUMN "in_stock"`
        )
        await queryRunner.query(
            `ALTER TABLE "materials" ADD COLUMN "quantity" INT DEFAULT 0`
        )
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `ALTER TABLE "products" ADD COLUMN "in_stock" BOOLEAN`
        )
        await queryRunner.query(
            `ALTER TABLE "materials" DROP COLUMN "quantity"`
        )
    }

}
