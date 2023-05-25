import { MigrationInterface, QueryRunner } from "typeorm"

export class createReportTable1670308612012 implements MigrationInterface {

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `CREATE TYPE "status" AS ENUM('sewing', 'packing', 'done')`
          );
        await queryRunner.query(
            `CREATE TABLE report(
                "id" uuid PRIMARY KEY NOT NULL DEFAULT uuid_generate_v4(),
                "type" VARCHAR(255) NOT NULL,
                "date_production" DATE NOT NULL, 
                "status" "status" NOT NULL, 
                "created_at" TIMESTAMP NOT NULL DEFAULT now(),
                "updated_at" TIMESTAMP NOT NULL DEFAULT now(),
                "product_id" uuid NOT NULL
                    REFERENCES products (id),
                "materials_id" uuid NOT NULL
                    REFERENCES materials (id)
                )`,
        )
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `DROP TABLE "report"`,
        )
        await queryRunner.query(
            `DROP TYPE "status"`,
        )
    }

}
