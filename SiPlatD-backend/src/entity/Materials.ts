import { Products } from "./Products";

import {
  Entity,
  JoinColumn,
  Column,
  PrimaryGeneratedColumn,
  CreateDateColumn,
  UpdateDateColumn,
  ManyToOne,
} from "typeorm";

export enum MATERIALS_TYPES {
  KAIN = "Kain",
  BENANG = "Benang",
  KARET = "Karet",
}

@Entity()
export class Materials {
  @PrimaryGeneratedColumn("uuid")
  id: string;

  @Column({
    type: "enum",
    enum: MATERIALS_TYPES,
  })
  category: MATERIALS_TYPES;

  @Column({
    type: "varchar",
    length: 255,
  })
  description: string;

  @Column({
    type: "int",
  })
  quantity: number;

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

  // @ManyToOne(() => Products, {
  //     cascade: false
  // })
  // @JoinColumn({ name: 'product_id'})
  // productLists: Products
}
