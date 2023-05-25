import { Products } from './Products';
import { Users } from './Users';
import {
    Entity,
    PrimaryGeneratedColumn,
    Column,
    CreateDateColumn,
    UpdateDateColumn,
    OneToOne,
    JoinColumn
} from "typeorm";

@Entity()
export class Transactions {
  @PrimaryGeneratedColumn("uuid")
  id: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  description: string;

  @Column({
    type: "int",
  })
  item_total: number;

  @Column({
    type: "numeric",
    precision: 18,
    scale: 2,
  })
  price_total: number;

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
  cashier_id: string

  // Reference all FK(s)
  @OneToOne(() => Products, {
    cascade: true,
    eager: true
  })
  @JoinColumn({
    name: 'product_id',
    referencedColumnName: "id"
  })
  product: Products

  @OneToOne(() => Users, {
    cascade: true,
    eager: true
  })
  @JoinColumn({
    name: 'cashier_id',
    referencedColumnName: "id"
  })
  cashier: Users
}
