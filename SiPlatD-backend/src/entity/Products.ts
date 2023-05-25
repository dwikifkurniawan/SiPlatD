import { Materials } from "./Materials";
import { Category } from "./Category";
import {
  Entity,
  Column,
  PrimaryGeneratedColumn,
  CreateDateColumn,
  UpdateDateColumn,
  DeleteDateColumn,
  OneToMany,
  ManyToOne,
  JoinColumn,
} from "typeorm";


@Entity()
export class Products {
  @PrimaryGeneratedColumn("uuid")
  id: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  name: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  description: string;

  @Column({
    type: "int",
  })
  price: number;

  @Column({
    type: "int",
  })
  stock_quantity: number;

  @CreateDateColumn({
    name: "created_at",
  })
  createdAt: Date;

  @UpdateDateColumn({
    name: "updated_at",
  })
  updatedAt: Date;

  @Column("uuid")
  manufacture_id: string;

  // @OneToMany(() => Materials, (listMaterials) => listMaterials.productLists, {
  //     cascade: true,
  //     onUpdate: 'CASCADE',
  //     onDelete: 'CASCADE'
  // })
  // materialsList: Materials[]
  
  @OneToMany(() => Category, (category: Category) => category.products, {
    cascade: true,
    onUpdate: 'CASCADE',
    onDelete: 'CASCADE'
  })
  @JoinColumn({
    name: 'category_id',
    referencedColumnName: "id"
  })
  category: Category;
}
