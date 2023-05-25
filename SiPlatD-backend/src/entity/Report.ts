import { Products } from './Products';
import { Materials } from './Materials';
import {
    Entity,
    PrimaryGeneratedColumn,
    Column,
    CreateDateColumn,
    UpdateDateColumn,
    OneToOne,
    JoinColumn
} from "typeorm";

export enum STATUS {
  SEWING = "sewing",
  PACKING = "packing",
  DONE = "done",
}

@Entity()
export class Report {
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
    date_production: Date;
  
    @CreateDateColumn({
      type: "timestamp",
      default: () => "CURRENT_TIMESTAMP(6)",
    })
    created_at: Date;
  
    @UpdateDateColumn({
      type: "timestamp",
      default: () => null,
      onUpdate: "CURRENT_TIMESTAMP(6)",
    })
    updated_at: Date;
  
    @Column({
      type: "uuid"
    })
    product_id: string
  
    @Column({
      type: "uuid"
    })
    materials_id: string
  
    // Reference all FK(s)
    @OneToOne(() => Products, {
      eager: true
    })
    @JoinColumn({
      name: 'product_id',
      referencedColumnName: "id"
    })
    product: Products
  
    @OneToOne(() => Materials, {
      eager: true
    })
    @JoinColumn({
      name: 'materials_id',
      referencedColumnName: "id"
    })
    material: Materials

  @Column({
    type: "enum",
    enum: STATUS,
  })
  status: STATUS;
}