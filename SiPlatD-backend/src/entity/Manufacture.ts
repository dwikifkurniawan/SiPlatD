import {
    Column,
    CreateDateColumn,
    Entity, JoinColumn,
    OneToMany,
    OneToOne,
    PrimaryGeneratedColumn,
    UpdateDateColumn
} from "typeorm"

import { Materials } from "./Materials";
import { Products } from "./Products";

export enum MANUFACTURE_STATUS {
    SEWING = "Sewing",
    PACKING = "Packing",
    CANCELED = "Canceled",
    DONE = "Done",
}

@Entity()
export class Manufacture {
    @PrimaryGeneratedColumn("uuid")
    id: string;

    @Column({
        type: "varchar",
        length: 255,
    })
    type: string;

    @Column({
        type: "date",
    })
    date: Date;

    @Column({
        type: "enum",
        enum: MANUFACTURE_STATUS,
    })
    status: MANUFACTURE_STATUS;

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
    product_id: string;

    @Column("uuid")
    material_id: string;

    // Reference all FK(s)
    @OneToOne(() => Products, {
      cascade: true,
      eager: true,
    })
    @JoinColumn({
      name: 'product_id',
      referencedColumnName: "id",
    })
    product: Products

    // @OneToMany(() => Materials, (material) => material.manufacture, {
    //   cascade: true,
    //   eager: true,
    // })
    // @JoinColumn({
    //   name: 'material_id',
    // })
    // materials: Materials[]
}
