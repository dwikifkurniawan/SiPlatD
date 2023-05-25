import { MigrationInterface, QueryRunner } from "typeorm"

export class createTransactionsTable1667183827299 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `CREATE TABLE transactions(
                "id" uuid PRIMARY KEY NOT NULL DEFAULT uuid_generate_v4(), 
                "description" VARCHAR(255), 
                "item_total" INT NOT NULL, 
                "price_total" NUMERIC(18, 2) NOT NULL, 
                "created_at" TIMESTAMP NOT NULL DEFAULT now(),
                "updated_at" TIMESTAMP NOT NULL DEFAULT now(),
                "product_id" uuid NOT NULL
                    REFERENCES products (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE,
                "cashier_id" uuid NOT NULL
                    REFERENCES users (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE
                )`,
        )
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `DROP TABLE "transactions"`,
        )
    }

}
