import { MigrationInterface, QueryRunner } from "typeorm"

export class createManufactureTable1670393380156 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `CREATE TYPE "manufactureStatus" AS ENUM('Sewing', 'Packing', 'Canceled', 'Done')`
        );
        await queryRunner.query(
            `CREATE TABLE manufactures(
                "id" uuid PRIMARY KEY NOT NULL DEFAULT uuid_generate_v4(), 
                "type" VARCHAR(255) NOT NULL, 
                "date" DATE NOT NULL DEFAULT now(), 
                "status" "manufactureStatus" NOT NULL, 
                "quantity" INT NOT NULL, 
                "created_at" TIMESTAMP NOT NULL DEFAULT now(),
                "updated_at" TIMESTAMP NOT NULL DEFAULT now(),
                "product_id" uuid NOT NULL
                    REFERENCES products (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE, 
                "material_id" uuid
            )`,
        )
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `DROP TABLE manufactures`,
        )
        await queryRunner.query(
            `DROP TYPE "manufacturesType"`,
        )
    }

}
