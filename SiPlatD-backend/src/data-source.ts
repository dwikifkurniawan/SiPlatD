import "reflect-metadata";
import { DataSource } from "typeorm";
import { Users } from "./entity/Users";
import { Materials } from "./entity/Materials";
import * as dotenv from "dotenv";
import { Products } from "./entity/Products";
import { Transactions } from "./entity/Transactions";
import { Category } from "./entity/Category";
import { Report } from "./entity/Report";
import { Manufacture } from "./entity/Manufacture";
dotenv.config();

export const AppDataSource = new DataSource({
    type: "postgres",
    host: process.env.POSTGRE_HOST,
    port: parseInt(process.env.POSTGRE_PORT),
    username: process.env.POSTGRE_USERNAME,
    password: process.env.POSTGRE_PASSWORD,
    database: process.env.POSTGRE_DATABASE,
    synchronize: false,
    logging: false,
    entities: [Users, Materials, Products, Transactions, Category, Report, Manufacture],
    migrations: [
        __dirname + '/migration/*.ts'
    ],
    subscribers: [],
})
