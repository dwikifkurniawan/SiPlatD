import { Products } from "./Products";
import {
    Entity,
    Column,
    PrimaryGeneratedColumn,
    OneToMany,
    ManyToOne
} from "typeorm";


@Entity()
export class Category {
    @PrimaryGeneratedColumn("uuid")
    id: string;

    @Column({
        type: "varchar",
        length: 255,
    })
    category: string;

    @ManyToOne(() => Products, products => products.category)
    products: Products;
}
