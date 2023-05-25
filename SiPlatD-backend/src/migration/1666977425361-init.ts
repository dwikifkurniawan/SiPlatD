import { MigrationInterface, QueryRunner } from "typeorm";

export class init1666977425361 implements MigrationInterface {
  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `CREATE TYPE "roles" AS ENUM('admin', 'owner', 'kasir')`
    );
    await queryRunner.query(
      `CREATE TYPE "materialsType" AS ENUM('Kain', 'Benang', 'Karet')`
    );
    await queryRunner.query(
      `CREATE TABLE users(
                "id" uuid PRIMARY KEY NOT NULL DEFAULT uuid_generate_v4(), 
                "firstName" VARCHAR (255) NOT NULL, 
                "lastName" VARCHAR(255) NOT NULL, 
                "email" VARCHAR(255) NOT NULL,
                "username" VARCHAR(255) UNIQUE NOT NULL,
                "password" VARCHAR(255) NOT NULL,
                "role" "roles" NOT NULL
                )`
    );
    await queryRunner.query(
      `CREATE TABLE category(
                "id" uuid PRIMARY KEY NOT NULL DEFAULT uuid_generate_v4(), 
                "category" VARCHAR(255) NOT NULL
                )`,
    );
    await queryRunner.query(
      `CREATE TABLE products(
                "id" uuid PRIMARY KEY NOT NULL DEFAULT uuid_generate_v4(), 
                "name" VARCHAR (255) NOT NULL, 
                "description" VARCHAR(255) NOT NULL, 
                "price" INT NOT NULL, 
                "in_stock" BOOLEAN NOT NULL DEFAULT TRUE,
                "created_at" TIMESTAMP NOT NULL DEFAULT now(),
                "updated_at" TIMESTAMP NOT NULL DEFAULT now(),
                "manufacture_id" uuid,
                "category_id" uuid NOT NULL
                    REFERENCES category (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE
                )`
    );
    await queryRunner.query(
      `CREATE TABLE materials(
                "id" uuid PRIMARY KEY NOT NULL DEFAULT uuid_generate_v4(), 
                "category" "materialsType" NOT NULL, 
                "description" VARCHAR(255) NOT NULL,
                "created_at" TIMESTAMP NOT NULL DEFAULT now(),
                "updated_at" TIMESTAMP NOT NULL DEFAULT now(),
                "manufacture_id" uuid
                )`,
        )
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(
            `DROP TABLE "products"`,
        )
        await queryRunner.query(
            `DROP TABLE "materials"`,
        )
        await queryRunner.query(
            `DROP TABLE "users"`,
        )
        await queryRunner.query(
            `DROP TABLE "category"`
        )
        await queryRunner.query(
            `DROP TYPE "roles"`,
        )
        await queryRunner.query(
            `DROP TYPE "materialsType"`,
        )
    }
}
